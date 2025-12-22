function selectNew() {
    var newL = document.getElementById("list");
    newL.classList.toggle("hidden");

    document.getElementById("ArrowSVG").classList.toggle("rotate-180");
}

function selectedSmall() {
    var text = event.target.innerText;
    var newL = document.getElementById("list");
    var newText = document.getElementById("textClicked");
    newL.classList.add("hidden");
    document.getElementById("ArrowSVG").classList.toggle("rotate-180");
    newText.innerText = text;

    document.getElementById("s1").classList.remove("hidden");
}

function toggleToLike(icon, numberOfLikesE, postId) {
    const likeBtn = document.getElementById(icon);
    const numberOfLikesElement = document.querySelector('#' + numberOfLikesE);
    const csrfToken = document.querySelector(`#form-${postId} input[name="_token"]`).value;
    const isLiked = likeBtn.classList.contains('isLiked');
    const actionUrl = `/posts/${postId}/react`;
    fetch(actionUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            if (!isLiked) {
                likeBtn.classList.add('isLiked');
                numberOfLikesElement.textContent = parseInt(numberOfLikesElement.textContent, 10) + 1;
            } else {
                likeBtn.classList.remove('isLiked');
                numberOfLikesElement.textContent = parseInt(numberOfLikesElement.textContent, 10) - 1;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function toggleElementById(Id) {
    const dropDown = document.getElementById(Id);
    dropDown.classList.toggle('opacity-0');
    dropDown.classList.toggle('pointer-events-none');
}

function handleClickAway(event) {
    const element = document.getElementById('dropdown-open')
    const dropDown = document.getElementById('categories-dropdown');
    if (element) {
        if (!element.contains(event.target) && !dropDown.contains(event.target)) {
            dropDown.classList.add('opacity-0');
            dropDown.classList.add('pointer-events-none');
        }
    }
}

document.addEventListener('click', handleClickAway)

function submitComment(formId , event) {
    event.preventDefault();
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    fetch('/create-comment', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': formData.get('_token')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Comment submitted successfully:', data);
                form.reset();
            } else {
                console.error('Error submitting comment:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
