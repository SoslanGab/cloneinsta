// async function getLikes() {
//     const response = await fetch("actions/get-likes.php", {
//         method: "POST",
//         headers: {
//             "Content-type": "application/json",
//         },
//         body: JSON.stringify({ key: 1 }),
//     });
//     return response.json();
// }


likeBtns = document.querySelectorAll(".fa-heart");

likeBtns.forEach(element => {
    data = 1;
    element.onclick = async(data)=>{
        const response = await fetch("actions/like.php", {
            method: "POST",
            headers: {
                "Content-type": "application/json",
            },
            body: JSON.stringify({ pictureId: data }),
        });
        return response.json();
    }
    
});

// async function likePost(picture) {
//     const response = await fetch("actions/like.php", {
//         method: "POST",
//         headers: {
//             "Content-type": "application/json",
//         },
//         body: JSON.stringify({ pictureId: picture }),
//     });
//     return response.json();
// }


function showCommentList(picId){
    let commentDiv = document.querySelector(`#commentList${picId}`);
    commentDiv.hidden = false;

}