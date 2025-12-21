document.addEventListener("DOMContentLoaded", () => {
    const nominateButtons = document.querySelectorAll(".nominate-btn");

    nominateButtons.forEach(button => {
        button.addEventListener("click", async () => {
            const gameId = button.dataset.gameId;

            const select = button.parentElement.querySelector(".nomination-category");
            const categoryId = select.value;

            if (!categoryId) {
                alert("Please choose a nomination category.");
                return;
            }

            try {
                const response = await fetch("/awards/nominate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        game_id: gameId,
                        category_id: categoryId
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    alert("Nomination submitted!");
                } else {
                    alert(result.message || "Error submitting nomination.");
                }

            } catch (error) {
                console.error("Nomination error:", error);
                alert("Something went wrong. Try again.");
            }
        });
    });
});
