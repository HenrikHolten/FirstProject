// app.test.js
const { beregnMoms } = require('./app');

test('Beregner korrekt 25% moms af 100 kr', () => {
    expect(beregnMoms(100)).toBe(25);
});

test('Håndterer negative tal og returnerer 0', () => {
    expect(beregnMoms(-50)).toBe(0);
});
