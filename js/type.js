'use strict';

const type = document.querySelector('.type-text');

let listTexts = ['Over 2.3M Recipes','Quick Recipes','Family Recipes','Fun Recipes','Popular Recipes'];

let index = -1;
let current = 0;

function typeTextFunc() {
    if (current === listTexts.length) {
        current = 0;
    }
    let typeText = setInterval(() => {
        if (index === listTexts[current].length - 1) {
            clearInterval(typeText);
            clearTextFunc();
        } else {
            index++;
            type.textContent += listTexts[current][index];
        }
    }, 100);
};

function clearTextFunc() {
    let clearText = setInterval(() => {
        if (type.textContent.length === 0) {
            clearInterval(clearText);
            index = -1;
            current++
            typeTextFunc();
        } else {
            type.textContent = type.textContent.slice(0, -1)
        }
    }, 75);
};

typeTextFunc();