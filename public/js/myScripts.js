// for prevent inputting of alphabets in the phone field of registration page
function isInputNumber(evt) {

    var ch = String.fromCharCode(evt.which);

    if (!(/[0-9, +]/.test(ch))) {
        evt.preventDefault();
    }
}






// for the moving slider
let slider = tns({
    container: ".my-slider",
    "slideby": 4,
    "speed": 300,
    "nav": false,
    "lazyload": true,
    "loop": true,
    "autoplay": true,
    controlsContainer: "#controls",
    prevButton: ".previous",
    nextButton: ".next",
    responsive: {
        1368: {
            items: 4,
            gutter: 0
        },
        1200: {
            items: 4,
            gutter: 0
        },
        1100: {
            items: 3,
            gutter: 0
        },
        767: {
            items: 2,
            gutter: 0
        },
        575: {
            items: 2,
            gutter: 0
        },
        480: {
            items: 2,
            gutter: 0
        }
    }
});




  