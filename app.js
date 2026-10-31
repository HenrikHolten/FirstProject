// app.js
function beregnMoms(beløb) {
    if (beløb < 0) return 0;
    return beløb * 0.25;
}

// Gør den tilgængelig for tests (hvis vi kører Node.js)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { beregnMoms };
}