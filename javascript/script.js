const overlay =document.querySelector(".overlay");
const createposts =document.querySelector(".createposts");
const cancelposts =document.querySelector(".cancelpost");
createposts.addEventListener("click",function(){
    overlay.classList.add("hideoverlay");
})
cancelposts.addEventListener("click",function(){
    overlay.classList.remove("hideoverlay");
})
