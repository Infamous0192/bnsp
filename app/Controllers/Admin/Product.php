<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Product extends BaseController
{
  protected $product;

  public function __construct()
  {
    $this->product = new ProductModel();
  }

  public function index()
  {
    return view('admin/product', [
      'title'        => 'Products',
      'products' => $this->product->findAll()
    ]);
  }

  public function add()
  {
    return view('admin/product-add', [
      'title'        => 'Add Product',
      'validation'     => \Config\Services::validation()
    ]);
  }

  public function update($id)
  {
    $product = $this->product->find($id);

    if ($product == null) return redirect()->to('/admin/product');

    return view('admin/product-update', [
      'title'        => 'Update Product',
      'product'   => $product,
      'validation'     => \Config\Services::validation()
    ]);
  }

  public function post()
  {
    if (!$this->validate([
      'title' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Judul harus diisi.'
        ]
      ],
      'description' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Deskripsi harus diisi.'
        ]
      ],
      'price' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => 'Harga harus diisi.',
          'integer'  => 'Harus berupa angka.'
        ]
      ],
      'thumbnail' => [
        'rules' => 'uploaded[thumbnail]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|max_size[thumbnail,1024]',
        'errors' => [
          'uploaded' => 'Foto harus diisi.',
          'is_image' => 'File harus berupa gambar',
          'mime_in'  => 'File harus berupa gambar',
          'max_size' => 'Ukuran maksimal 1mb',
        ]
      ],
    ])) {
      return redirect()->back()->withInput();
    }

    $thumbnail = $this->request->getFile('thumbnail');
    $fileName = $thumbnail->getRandomName();
    $thumbnail->move('files/product', $fileName);

    $this->product->insert([
      'title' => $this->request->getVar('title'),
      'description' => $this->request->getVar('description'),
      'price' => $this->request->getVar('price'),
      'thumbnail' => $fileName,
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
    return redirect()->to('admin/product');
  }

  public function put($id)
  {
    if (!$this->validate([
      'title' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Judul harus diisi.'
        ]
      ],
      'description' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Deskripsi harus diisi.'
        ]
      ],
      'price' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => 'Harga harus diisi.',
          'integer'  => 'Harus berupa angka.'
        ]
      ],
    ])) {
      return redirect()->back()->withInput();
    }

    $thumbnail = $this->request->getFile('thumbnail');
    $oldThumbnail = $this->request->getVar('oldThumbnail');

    if ($thumbnail->getError() == 4) {
      $fileName = $oldThumbnail;
    } else {
      $fileName = $thumbnail->getRandomName();
      $thumbnail->move('files/product', $fileName);

      unlink('files/product' . $oldThumbnail);
    }

    $this->product->update($id, [
      'title' => $this->request->getVar('title'),
      'description' => $this->request->getVar('description'),
      'price' => $this->request->getVar('price'),
      'thumbnail' => "files/product/$fileName",
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah.');
    return redirect()->to(base_url('admin/product'));
  }

  public function delete($id)
  {
    $product = $this->product->find($id);
    // Hapus file foto
    unlink('files/product/' . $product['foto']);
    // Hapus data
    $this->product->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to(base_url() . '/admin/product');
  }
}
