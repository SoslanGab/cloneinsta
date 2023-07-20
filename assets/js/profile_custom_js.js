async function getLikes() {
    const response = await fetch("actions/get-likes.php", {
        method: "POST",
        headers: {
            "Content-type": "application/json",
        },
        body: JSON.stringify({ key: 1 }),
    });
    return response.json();
}

function likePost(pictureId){

}