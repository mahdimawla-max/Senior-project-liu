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

function toggleElementById(Id) {
    const dropDown = document.getElementById(Id);
    dropDown.classList.toggle("opacity-0");
    dropDown.classList.toggle("pointer-events-none");
}

function handleClickAway(event) {
    const element = document.getElementById("dropdown-open");
    const dropDown = document.getElementById("categories-dropdown");
    if (element) {
        if (
            !element.contains(event.target) &&
            !dropDown.contains(event.target)
        ) {
            dropDown.classList.add("opacity-0");
            dropDown.classList.add("pointer-events-none");
        }
    }
}

document.addEventListener("click", handleClickAway);

/* =========================
   ❤️ LIKE (FIXED & SAFE)
========================= */
function toggleToLike(el) {
    const postId = el.dataset.postId;
    const countEl = el.nextElementSibling;

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch(`/posts/${postId}/react`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    })
        .then(() => {
            // Optimistic UI update
            el.classList.toggle("isLiked");

            const current = parseInt(countEl.textContent, 10);
            countEl.textContent = el.classList.contains("isLiked")
                ? current + 1
                : current - 1;
        })
        .catch((err) => {
            console.error("React failed:", err);
        });
}

/* =========================
   💬 COMMENT SUBMIT (FIXED)
========================= */
function submitComment(form, event) {
    event.preventDefault();

    const formData = new FormData(form);

    fetch("/create-comment", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": formData.get("_token"),
            Accept: "application/json",
        },
    })
        .then((res) => res.json())
        .then(() => {
            form.reset();
        })
        .catch(console.error);
}
