<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item <?= ($uri1 == 'index') ? 'active' : '' ?> ">
                    <a href="/user" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri1 == 'product') ? 'active' : '' ?> ">
                    <a href="/user/product" class='sidebar-link'>
                        <i class="bi bi-laptop-fill"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri1 == 'cart') ? 'active' : '' ?> ">
                    <a href="/user/cart" class='sidebar-link'>
                        <i class="bi bi-basket-fill"></i>
                        <span>Carts</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri1 == 'transaction') ? 'active' : '' ?> ">
                    <a href="/user/transaction" class='sidebar-link'>
                        <i class="bi bi-cart-fill"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <!-- <li class="sidebar-item <?= ($uri1 == 'product') ? 'active' : '' ?> ">
                    <a href="/user/user" class='sidebar-link'>
                        <i class="bi bi-user-fill"></i>
                        <span>User</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>