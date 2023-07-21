document.addEventListener("DOMContentLoaded", () => {
const likeBtns = document.querySelectorAll(".fa-heart");

likeBtns.forEach(element => {
    element.onclick = async (event) => {
        let pictureliked = event.target.id.replace("like", "");
        try {
            const response = await fetch("actions/like.php", {
              method: "POST",
              headers: {
                "Content-type": "application/json",
              },
              body: JSON.stringify({ "pictureId": pictureliked }),
            });
          
            if (!response.ok) {
              throw new Error("La requête n'a pas abouti !");
            }
          
            const data = await response.json();
          

            if (data['likestatus'] === "posted") {
              event.target.style = "color: red;";
              let currentLikes = parseInt(event.target.innerHTML);
              event.target.innerHTML = currentLikes+1;
            } else if(data['likestatus'] === "removed") {
              event.target.style = "";
              let currentLikes = parseInt(event.target.innerHTML);
              event.target.innerHTML = currentLikes-1;
            }
          } catch (error) {
            console.error(error);
          }          
    };
});
});



function showCommentList(picId){
  let commentDiv = document.querySelector(`#commentList${picId}`);
  if(commentDiv.hidden === true){
    commentDiv.hidden = false;
  } else {
    commentDiv.hidden = true;
  }
}