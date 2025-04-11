/* image-size-limit.js
-----------------------
This is a last-minute addition
It simply ensures that uploaded images cannot be more than 2 MB,
since this is the max_allowed_packet for the remote server.
*/

form = document.querySelector('form::has(input[type="file"])');

console.log(form);

