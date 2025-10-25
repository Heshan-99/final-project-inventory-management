<section class="cust--header">
    <div class="search--notification--profile">
        <div class="logo">
            <h2>Happy<span>Cakies</span></h2>
        </div>
        <div class="cust--greeting">
            <h1 style="">Hello, <span>Have a nice day!</span></h1>
        </div>

        <div class="notification--profile">
            <div class="theme-toggler">
                <span class="material-symbols-outlined activedark">sunny</span>
                <span class="material-symbols-outlined">dark_mode</span>
            </div>
            <div class="icon-cart">
                <div class="picon lock" style="cursor: pointer">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
            </div>
            <div class="picon bell">
                <span class="material-symbols-outlined">notifications</span>
            </div>
            <div class="picon chat">
                <span class="material-symbols-outlined">chat</span>
            </div>
            <div class="picon profile">
            </div>
        </div>
    </div>


</section>

<script>
    let iconCart = document.querySelector('.icon-cart');
    let closeCart = document.querySelector('.close');
    let body = document.querySelector('body');
    let listProductHTML = document.querySelector('.listProduct');
    let listCartHTML = document.querySelector('.listCart');
    let iconCartSpan = document.querySelector('.icon-cart span');

    let listProducts = [];
    let carts = [];

    iconCart.addEventListener('click', () => {
        body.classList.toggle('showCart')
    })
    closeCart.addEventListener('click', () => {
        body.classList.toggle('showCart')
    })
</script>
