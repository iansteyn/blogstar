/* admin.js
 * --------
 * Scripting for the admin page.
 * Adds an event listener to searchbar which dynmically updates the displayed userlist
 * by sending AJAX requests to the server and receiving its responses.
 */

const searchInput = document.querySelector('.search-bar input[type="search"]');

searchInput.addEventListener('input', ()=> handleSearchInput());

// More AJAX!
function handleSearchInput() {
    let searchTerm = searchInput.value;

    fetch(`/admin/search-users?terms=${encodeURIComponent(searchTerm)}`)
    .then(response =>                   // Recieve response from server
        response.json()
    )
    .then(data => {                     // perform action based on response
        updateUserList(data.usernames)
    })
    .catch(error => {                   // catch and log network errors
        console.error('Error:', error);
    });
}

function updateUserList(usernames) {
    console.log(usernames);
}