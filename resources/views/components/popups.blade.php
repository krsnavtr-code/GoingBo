<style>
    .popup_wrapper {
        position: fixed;
        background: #00000066;
        height: 100%;
        width: 100%;
        display: flex;
        z-index: 3;
        align-items: center;
        justify-content: center;
    }

    .popup_wrapper:not(:has(.popup.active)) {
        display: none;
    }

    .popup {
        margin: 20px;
        overflow: auto;
        max-height: calc(100% - 40px);
        background: white;
        width: min(100%, 450px);
        min-height: 230px;
        position: relative;
        border-radius: 6px;
        box-shadow: 0 0 20px 0 #00000066;
        border-bottom: 6px solid;
    }

    .popup .popup_header {
        display: flex;
        align-items: center;
        display: none;
        padding: 10px;
        border-bottom: 1px solid var(--gray_500);
    }

    .popup .popup_header .popup_details {
        margin-left: 10px;
    }

    .popup .popup_header .popup_desc {
        font-size: 0.7em;
        color: var(--gray_600);
        font-weight: 500;
    }

    .popup i {
        width: 40px;
        font-size: 2rem;
        aspect-ratio: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .popup .close_popup {
        margin-left: auto;
        cursor: pointer;
        font-size: 1.8rem;
        color: var(--gray_500);
        position: absolute;
        right: 0;
    }

    .popup .popup_content {
        flex-grow: 1;
    }

    .popup .popup_content>div {
        display: flex;
        flex-direction: column;
        padding: 0 20px;
    }

    .popup .popup_content>div:not(.active) {
        display: none;
    }

    .popup .img_wrap {
        height: 120px;
        margin: 20px auto 5px;
    }

    .popup .img_wrap :is(img, svg) {
        height: 100%;
    }

    .popup .popup_content .popup_details {
        text-align: center;
        padding: 15px 0 10px;
    }

    .popup .popup_content .popup_details .popup_desc {
        font-size: 0.75em;
        line-height: 1.6;
        font-weight: 500;
    }

    .popup .popup_content .actions {
        margin: 0px auto 20px;
        gap: 10px;
        display: flex;
        flex-wrap: wrap-reverse;
    }

    .popup .popup_content .actions button {
        padding: 8px 30px;
        border: none;
        font-weight: 600;
        letter-spacing: 0.6px;
        border-radius: 5px;
        flex-grow: 1;
        user-select: none;
    }

    .popup .popup_content .actions button.prime {
        background: var(--success);
        color: white;
    }
</style>
<div class="popup_wrapper">
    <div class="popup rflex">
        <i class="fa-solid fa-xmark close_popup"></i>
        <div class="popup_content" id="popup_content">
            @stack('popup')
        </div>
    </div>
</div>
