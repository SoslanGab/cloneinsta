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
          
            // Vérification de la validité de la réponse JSON
            if (typeof data === "object") {
              // Faites ici ce que vous voulez avec la réponse JSON
              // Par exemple, vous pouvez mettre à jour l'interface utilisateur en fonction de la réponse.
              console.log(data);
            } else {
              console.log(data);
              console.error("La réponse n'est pas un objet JSON valide.");
            }
          } catch (error) {
            console.error(error);
          }          
    };
});
});



function showCommentList(picId){
    let commentDiv = document.querySelector(`#commentList${picId}`);
    commentDiv.hidden = false;

}