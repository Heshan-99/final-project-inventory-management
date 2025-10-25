<section>
    <button class="show-modal">Show Modal</button>
    <span class="overlay"></span>

    <div class="modal-box">
        <span class="material-symbols-outlined">lock_reset</span>
        <h2>Change password</h2><div>
            <table>
                <tr>
                    <td>
                        <label>Old password</label>
                    </td>
                    <td>
                        <input type="password" name="oldPass" id="oldPassfield"><br>
                        <h6 style="color: red;" class="d-none" id="oldPass_msg">Required field</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>New password</label>
                    </td>
                    <td>
                        <input type="password" name="newPass" id="newPassfield" ><br>
                        <h6 style="color: red;" class="d-none" id="newPass_msg">Required field</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Confirm password</label>
                    </td>
                    <td>
                        <input type="password" name="confirmPass" id="confirmPassfield"><br>
                        <h6 style="color: red;" class="d-none" id="confirmPass_msg">Required field</h6>
                    </td>
                </tr>
            </table>
        </div>
        <div class="buttons">
            <button class="close-btn">Close</button>
            <button>Reset</button>
        </div>
    </div>
</section>
<script>
    const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".close-btn");

    showBtn.addEventListener("click", () => section.classList.add("active"));

    overlay.addEventListener("click", () =>
        section.classList.remove("active")
    );

    closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
    );
</script>
<style>.modal-box {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }
    section.active .show-modal {
        display: none;
    }
    .overlay {
        position: fixed;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.3);
        opacity: 0;
        pointer-events: none;
    }
    section.active .overlay {
        opacity: 1;
        pointer-events: auto;
    }
    .modal-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 380px;
        width: 100%;
        padding: 30px 20px;
        border-radius: 24px;
        background-color: #fff;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
        transform: translate(-50%, -50%) scale(1.2);
    }
    section.active .modal-box {
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
    }
    .modal-box i {
        font-size: 70px;
        color: #4070f4;
    }
    .modal-box h2 {
        margin-top: 20px;
        font-size: 25px;
        font-weight: 500;
        color: #333;
    }
    .modal-box h3 {
        font-size: 16px;
        font-weight: 400;
        color: #333;
        text-align: center;
    }
    .modal-box .buttons {
        margin-top: 25px;
    }
    .modal-box button {
        font-size: 14px;
        padding: 6px 12px;
        margin: 0 10px;
    }</style>