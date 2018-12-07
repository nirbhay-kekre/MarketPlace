function postRatingToServer(){
    var firstname = document.forms["postReviewForm"]["firstname"].value;
    var lastname = document.forms["postReviewForm"]["lastname"].value;
    var productId = document.forms["postReviewForm"]["productId"].value;
    var from = document.forms["postReviewForm"]["from"].value;
    var userId = document.forms["postReviewForm"]["userId"].value;
    var textReview = document.forms["postReviewForm"]["textReview"].value;
    var rating = document.forms["postReviewForm"]["rating"].value;
    console.log({
        firstname,
        lastname,
        productId,
        from,
        userId,
        textReview,
        rating
    });
    debugger;
    fetch('http://cmpe272marketplace.ml/market_place_dev_nirbhay/postReview.php', {
    method: 'POST',
    body: {
        firstname,
        lastname,
        productId,
        from,
        userId,
        textReview,
        rating
    }, 
    headers:{
      'Content-Type': 'application/json'
    }
  });
  return false;//to stop redirecting
}