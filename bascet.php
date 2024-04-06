<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Лидер поиска</title>
    <link rel="stylesheet" href="css/bascet.css">
    <script src="https://kit.fontawesome.com/6da2f20eab.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
$arr=file('info.txt');
$arr1=array_pop($arr);
?>
<div class="container">
    <ul class="main_ul">
        <ul>
            <li><a href="index.php"><img src="image/lp_logo%201.png" alt=""></a></li>

        </ul>
        <ul class="last_ul" style="display: flex; align-items: center">
            <li><a href="bascet.php"><i class="fa-solid fa-basket-shopping"></i></a></li>
            <li class="basket">Корзина</li>
            <li class="sum"><span class="sum"> <?php
                    if(empty($arr1)){
                        echo 0;
                    }
                    else {
                        $arr1 = json_decode($arr1, true);
                        echo count($arr1);
                    }



            ?></span></li>
        </ul>
    </ul>

    <h1 style="text-align: center">Корзина</h1>
    <div class="catalog">
    <?php

    if(empty($arr1)){
       header('location:index.php');
    }
    else {
        foreach ($arr1 as $i => $item) {
            echo '<div id="' . $item['id'] . '" class="catalog_image">
            <div class="img"><img src="' . $item['src'] . '"></div>
            <div class="text">' . $item['text'] . '</div><div class="count"><div class="minus"><i data-action="minus" class="fa-solid fa-minus" ></i></div><div class="counter">'.$item['num'].' </div><div class="plus">                
             <i data-action="plus" class="fa-solid fa-plus"></i></div></div><div class="price1"><div class="price">' . $item['price']. '  </div><span class="rub"> <b>&nbsp;₽</b> </span></div> 
           <div class="close"><i data-action="close" class="fa-solid fa-xmark"></i></div> </div>';
        }
        echo "<div class='itogo'><h1 style='display: inline'>Сумма </h1><b class='summa'></b><span> ₽</span></div>";
    }
    ?>
    </div>
</div>
<div id="form">
    <h1>Пожалуйста, представьтесь</h1>
    <form autocomplete="off">
        <input type="text" id='name' placeholder="Ваше имя" name="name" >
        <input type="tel" id="tel" placeholder="Телефон" name="tel" autocomplete="off">
        <input type="email" id='email' placeholder="Email" name="email" autocomplete="off">

        <div id="error"></div>
        <button id="button"  disabled type="button">Оформить заказ</button>
    </form>

</div>

<div class="popup">
    <div class="popup_mini">
        <img src="image/close.svg" alt="">
        <h3>Спасибо <b class="name"></b>, ваш заказ <b>№</b><b class="order"></b> оформлен </h3>
        <p>В ближайшее время мы свяжемся с вами по телефону <b class="tel"></b> для его подтверждения.</p>
    </div>
</div>



</body>
</html>
<script>

    let closeAll=sessionStorage.getItem('box')?JSON.parse(sessionStorage.getItem('box')):[];
console.log(closeAll);


    function addSum(){
        let price1= document.querySelectorAll('.price');
        let summa=document.querySelector('.summa');
        let sum=0;

        price1.forEach(function ($item){
            sum+=parseInt($item.innerText);

        })

        summa.innerText=sum;


    }
    addSum();


window.onclick=function (event) {


    let block;
    let price;
    let count;

    if (event.target.dataset.action === 'plus' || event.target.dataset.action === 'minus'){


        let block = event.target.closest('.catalog_image');
        let price= block.querySelector('.price');
        let count = block.querySelector('.counter');

 if(event.target.dataset.action==='plus'&& count.innerText<=9){

     count.innerText=++count.innerText;

     price.innerText=(parseInt(price.innerText)/(parseInt(count.innerText)-1)*parseInt(count.innerText));
     addSum();
     let id_block1 = event.target.closest('.catalog_image');
     let id1= id_block1.getAttribute("id");
     let src1 = id_block1.querySelector('img').getAttribute("src");
     let text1 = id_block1.querySelector('.text').textContent;
     let price1 = id_block1.querySelector('.price').textContent;
     let num = id_block1.querySelector('.counter').textContent;

     let obj1 = {
         id: id1,
         src: src1,
         text: text1,
         price: price1,
         num:num
     }

     let load = function (url, callback) {
         let ajax = new XMLHttpRequest();
         ajax.open('POST', url);
         ajax.onload = function () {
             callback(this.responseText);
         }
         ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8")
         ajax.send(JSON.stringify(obj1));
     }
     load('ajax/ajax2.php', function (data) {
         console.log(data);

     })
 }


    if(event.target.dataset.action=== 'minus' && count.innerText>1){
        count.innerText=--count.innerText;
        price.innerText=parseInt(price.innerText)/(parseInt(count.innerText)+1)*parseInt(count.innerText);
        addSum();
        let id_block1 = event.target.closest('.catalog_image');
        let id1= id_block1.getAttribute("id");
        let src1 = id_block1.querySelector('img').getAttribute("src");
        let text1 = id_block1.querySelector('.text').textContent;
        let price1 = id_block1.querySelector('.price').textContent;
        let num = id_block1.querySelector('.counter').textContent;
        let obj1 = {
            id: id1,
            src: src1,
            text: text1,
            price: price1,
            num:num
        }

        let load = function (url, callback) {
            let ajax = new XMLHttpRequest();
            ajax.open('POST', url);
            ajax.onload = function () {
                callback(this.responseText);
            }
            ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8")
            ajax.send(JSON.stringify(obj1));
        }
        load('ajax/ajax2.php', function (data) {
            console.log(data);

        })
    }
    }
}

let plus=document.querySelectorAll(".plus");
let minus=document.querySelectorAll(".minus");
let close=document.querySelectorAll(".close");

let arr1=[];


    window.addEventListener('click',function (event){


        if(event.target.dataset.action === 'close') {

            let id_block1 = event.target.closest('.catalog_image');
            let id1= id_block1.getAttribute("id");
            console.log(id1);
            let src1 = id_block1.querySelector('img').getAttribute("src");
            let text1 = id_block1.querySelector('.text').textContent;
            let price1 = id_block1.querySelector('.price').textContent;

        const index = closeAll.findIndex(index => index.id === id1);
        closeAll.splice(index, 1);
        sessionStorage.setItem('box', JSON.stringify(closeAll));


            let obj1 = {
                id: id1,
                src: src1,
                text: text1,
                price: price1
            }
            arr1.push(obj1);


            let load = function (url, callback) {
                let ajax = new XMLHttpRequest();
                ajax.open('POST', url);
                ajax.onload = function () {
                    callback(this.responseText);
                }
                ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8")
                ajax.send(JSON.stringify(arr1));
            }
            load('ajax/ajax1.php', function (data) {
                console.log(data);
                document.location.reload();
        })
    }

    })

    plus.forEach(function ($item){
       $item.onmouseover=function () {
           $item.style.background = "#296DC1";

       }

       $item.onmouseout=function () {
           $item.style.background = "white";
       }

   })
minus.forEach(function ($item){
    $item.onmouseover=function () {
        $item.style.background = "#296DC1";

    }

    $item.onmouseout=function () {
        $item.style.background = "white";
    }

})
close.forEach(function ($item){
    $item.onmouseover=function () {
        $item.style.background = "#296DC1";

    }

    $item.onmouseout=function () {
        $item.style.background = "white";
    }

})


//Проверяем email,формируем объект и отправляем письмо
    let catalog=document.querySelector('.catalog');
    let go=document.querySelector('#button');
    let name=document.querySelector('#name');
    let tel=document.querySelector('#tel');
    let email=document.querySelector('#email');
    let error=document.querySelector('#error');


     let sumCounter1=[];
    let sumCounter=catalog.querySelectorAll('.counter');
    sumCounter.forEach(function (item, i, array){
        sumCounter1.push(item.textContent)})


     let idSum=[];
     let sumId=catalog.querySelectorAll('.catalog_image');
     sumId.forEach(function (item, i, array){
         let idElement=item.getAttribute("id");
         idSum.push(idElement);

})


    function validateEmail(email) {
        var re = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        return re.test(String(email).toLowerCase());
    }
    email.addEventListener('input',function (){

        if(validateEmail(email.value)){

            go.removeAttribute('disabled');
            go.setAttribute('enabled', '');
            go.style.background = '#296DC1';
            error.innerText = '';
            email.style.border='none';
        }

        else if(email.value===''){
            go.style.background = '#296DC180';
            go.setAttribute('disabled', '');
            error.innerText = '';
            email.style.border='none';
        }
        else{
            error.innerText='Поле заполнено не верно';
            email.style.border='1px solid red';
            error.style.color='red';
            go.style.background = '#296DC180';
            go.setAttribute('disabled', '');
            email.style.outline='none';
        }

    })

let number_order=window.localStorage.getItem('number_order');
    let popup=document.querySelector('.popup');




    //Отпраляем заказ на почту
    go.addEventListener('click',function () {
        number_order++;
        window.localStorage.setItem('number_order', number_order);
        let object = {
            name: name.value,
            tel: tel.value,
            email: email.value,
            id:idSum,
            counter:sumCounter1,
            number_order:window.localStorage.getItem('number_order')
        }

        console.log(window.localStorage.getItem('number_order'));

        let load = function (url, callback) {
            let ajax = new XMLHttpRequest();
            ajax.open('POST', url);
            ajax.onload = function () {
                callback(this.responseText);
            }
            ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8")
            ajax.send(JSON.stringify(object));
        }
        load('ajax/mail.php', function (data) {


            let popup_name=document.querySelector('.name');
            let popup_order=document.querySelector('.order');
            let popup_tel=document.querySelector('.tel');

            if(data==='Done') {

                popup.style.display = 'flex';
                popup_name.innerText = name.value;
                popup_order.innerText = window.localStorage.getItem('number_order');
                popup_tel.innerText = tel.value;

            }
        })
    })

    let close1=document.querySelector('.popup_mini img');

    close1.addEventListener('click',function (){
        popup.style.display = 'none';
        window.location.href='index.php';

sessionStorage.removeItem('box');



    })




</script>

