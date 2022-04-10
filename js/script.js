const popupLink = document.querySelector('.popup-link')
const body = document.querySelector('body');
const lockPadding = document.querySelector(".lock-padding");

let unlock = true;

const timeout = 800;

popupLink.addEventListener("click",function(e){
    const popupName = popupLink.getAttribute('href').replace('#','');
    const curentPopup = document.getElementById(popupName);
    popupOpen(curentPopup);
    e.preventDefault();
});

const popupCloseIcon = document.querySelector('.close-popup');
popupCloseIcon.addEventListener('click',function(e){
    popupClose(popupCloseIcon.closest('.popup'));
    e.preventDefault();

});

function popupOpen (curentPopup) {
    if(curentPopup && unlock){
        const popupActive = document.querySelector('.popup.open');
        if(popupActive){
            popupClose(popupActive,false);
        }else{
            bodyLock();
        }
        curentPopup.classList.add('open');
        curentPopup.addEventListener('click',function (e){
            if(!e.target.closest('.popup__content')){
                popupClose(e.target.closest('.popup'));
            }
        });
    }
}

function popupClose(popupActive, doUnlock = true){
    if(unlock){
        popupActive.classList.remove('open');
        if(doUnlock){
            bodyUnLock();
        }
    }
}

function bodyLock(){
    const lockPaddingValue = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
    const el = lockPadding;
    el.style.paddingRight = lockPaddingValue;
    body.style.paddingRight = lockPaddingValue;
    body.classList.add('lock');
    unlock = false;
    setTimeout(function (){
        unlock = true;
    },timeout);
}

function bodyUnLock() {
    setTimeout(function (){
        const el = lockPadding;
        el.style.paddingRight = '0px';
        body.style.paddingRight = '0px';
        body.classList.remove('lock');
    },timeout);
    unlock = false;

    setTimeout(function (){
        unlock = true;
    },timeout);
}

document.addEventListener('keydown',function(e){
    if(e.which === 27){
        const popupActive = document.querySelector('.popup.open');
        popupClose(popupActive);
    }
})

const form = document.getElementById('form');
form.addEventListener('submit',formSend);
async function formSend(e) {
    e.preventDefault();

    let formData = new FormData(form);
    let response = await fetch('popupscript.php',{
        method: 'POST',
        body: formData
        });

}
