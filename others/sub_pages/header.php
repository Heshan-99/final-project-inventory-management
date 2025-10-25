<section class="header">
    <div class="search--notification--profile">
        <div class="greeting">
            <h1 style="">Hello, <span><?php echo $_SESSION['name']; ?> !<span style="font-size: 15px;"> <?php echo " (";
                        echo $_SESSION['designation'];
                        echo ")" ?></span></span></h1>
        </div>

        <div class="notification--profile">
<!--                <button class="my-print-btn" type="button" id="printLowQty" style="width: 170px; height: 40px"><span><span style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">print</span>&nbsp;  Low Items (<span  style="color: red" id="lowQunt">-</span>)</span></button>-->


            <div class="picon profile">
                <img src="./others/upload_emp/<?php echo $_SESSION['photo']; ?>" alt="Profile Photo"
                     style="width: 40px; height: 40px; border-radius: 50px; border: 1px solid #939393">
            </div>
        </div>
    </div>
</section>

