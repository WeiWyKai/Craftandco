import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

function showRecipe(id) {
  let overlay = document.createElement("div");
  overlay.className = 'overlay';
  overlay.style.cssText = `
    background-color: rgba(174, 149, 109, 0.6);
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: grid;
    place-items: center;
  `;
  document.querySelector("h1").before(overlay);

  let close = document.createElement('img');
  close.className= 'hide border border-warning bg-light shadow'
  close.style.cssText = `
    top: 2rem;
    right: 2rem;
    width: 3rem;
    height: 3rem;
    position: fixed;
  `;
  close.src= "/img/traverser.png";
  close.alt= "fermer image";
  document.querySelector('.overlay').append(close);
  document.querySelector('.hide').addEventListener('click',hideDetail);

  let recipeDetail = document.createElement("img");
    recipeDetail.style.cssText = `
    position: fixed;
    max-height: 95%;
    max-width: 90%;
    object-fit: contain;
  `;
  let recipeData = document.querySelector(`.recipeDetail${id}`)
  console.log(recipeData)
  recipeDetail.src= recipeData.dataset.preview ;
  recipeDetail.alt= recipeData.dataset.name;
  document.querySelector('.overlay').append(recipeDetail);

}

function hideDetail(){
  document.querySelector('.overlay').remove();
}

document.querySelectorAll('#recipe').forEach((element)=>{
  let id=element.dataset.number;
  element.addEventListener('click', () =>showRecipe(id)
  )
})

document.querySelectorAll('div>a').forEach((link)=>{
  link.addEventListener('click',()=>{
    location.reload()
  })
})