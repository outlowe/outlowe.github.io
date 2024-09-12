document.addEventListener('DOMContentLoaded', () => {
    const url = 'https://meowfacts.herokuapp.com/';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById('facts').innerHTML = `
                <p>${data.fact}</p>
            `;
        })
        .catch(error => console.error('API çağrısında bir hata oluştu:', error));
});
