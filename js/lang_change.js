var elements = document.querySelectorAll('label');

elements.forEach(function(element) {
    var textContent = element.innerText || element.textContent;

    var hasThai = /[\u0E00-\u0E7F]/.test(textContent);

    if (hasThai) {
        element.classList.add('kanit-font');
    } else {
        element.classList.add('nunito-font');
    }
});