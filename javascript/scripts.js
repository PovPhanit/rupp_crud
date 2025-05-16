const overlay =document.querySelector(".overlaypost");
const overlaydelete =document.querySelector(".overlaydelete");
const createposts =document.querySelector(".createposts");
const cancelposts =document.querySelector(".cancelposts");
const canceldelete =document.querySelector(".canceldelete");
createposts.addEventListener("click",function(){
    overlay.classList.add("hideoverlay");
})
cancelposts.addEventListener("click",function(){
    overlay.classList.remove("hideoverlay");
})
canceldelete.addEventListener("click",function(){
    overlaydelete.classList.remove("hideoverlay");
})
