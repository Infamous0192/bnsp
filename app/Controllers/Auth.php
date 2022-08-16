<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
  protected $user;

  public function __construct()
  {
    $this->user = new UserModel();
  }

  public function masuk()
  {
    return view('auth/login', [
      'title' => 'Login',
      'validation' => \Config\Services::validation()
    ]);
  }

  public function daftar()
  {
    return view('auth/register', [
      'title' => 'Register',
      'validation' => \Config\Services::validation()
    ]);
  }

  public function login()
  {
    if (!$this->validate([
      'username' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Username harus diisi.',
        ]
      ],
      'password' => [
        'rules'  => 'required|min_length[4]',
        'errors' => [
          'required'   => 'Password harus diisi.',
          'min_length' => 'Minimal 4 karakter.',
        ]
      ],
    ])) {
      return redirect()->back()->withInput();
    }

    $data = $this->request->getVar();
    $user = $this->user->where('username', $data['username'])->first();

    if (!$user) {
      session()->setFlashdata('pesan', 'Username tidak ditemukan');
      return redirect()->back()->withInput();
    }

    if (sha1($data['password']) !== $user['password']) {
      session()->setFlashdata('pesan', 'Password salah');

      return redirect()->back()->withInput();
    } else {
      session()->set([
        'id' => $user['id'],
        'name' => $user['name'],
        'username' => $user['username'],
        'role' => $user['role']
      ]);

      if ($user['role'] == 'admin') {
        dd('test');
        return redirect()->to('/admin');
      }

      return redirect()->to('/user');
    }
  }

  public function register()
  {
    if (!$this->validate([
      'name' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Nama harus diisi.'
        ]
      ],
      'username' => [
        'rules'  => 'required|is_unique[users.username]',
        'errors' => [
          'required' => 'Username harus diisi.',
          'is_unique' => 'Username sudah terdaftar.',
        ]
      ],
      'password' => [
        'rules'  => 'required|min_length[4]',
        'errors' => [
          'required'   => 'Password harus diisi.',
          'min_length' => 'Minimal 4 karakter.',
        ]
      ],
    ])) {
      return redirect()->back()->withInput();
    }

    $this->user->insert([
      'name'  => $this->request->getVar('name'),
      'username'      => strtolower($this->request->getVar('username')),
      'password'      => sha1($this->request->getVar('password')),
      'role' => 'user'
    ]);

    session()->setFlashdata('pesan', 'Akun Berhasil Dibuat.');
    return redirect()->to(base_url() . '/masuk');
  }
}
