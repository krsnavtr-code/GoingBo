class vu_select {
    constructor(node, fetch_opt, optGenerator) {
        this.vu_select = node;
        this.vu_select_box = node.$(".vu-select-box")[0];
        this.option_box = node.$(".vu-options")[0];
        this.main_input = node.$(".vu-input")[0];
        this.options = [];

        // Fetch options dynamically and populate
        this.fetchOptions = fetch_opt;
        this.optGenerator = optGenerator;

        this.vu_select_box.addEventListener("click", () => {
            this.vu_select.hasClass("active")
                ? this.hideOptions()
                : this.showOptions();
            document.addEventListener("click", this.domHide);
        });

        this.main_input.addEventListener("input", () => this.handleInput());
    }

    handleInput() {
        const inputValue = this.main_input.value.trim();
        if (inputValue == "") {
            this.hideOptions();
            return;
        }

        // Fetch options dynamically based on the input value
        this.fetchOptions(inputValue, (optionsData) => {
            this.populateOptions(optionsData);
            this.showOptions();
        });
    }

    populateOptions(optionsData) {
        this.option_box.innerHTML = "";
        optionsData.forEach((option) =>
            this.option_box.append(this.optGenerator(option))
        );
        this.options = this.vu_select.$(".vu-option");
        this.options.perform((n) => {
            n.addEventListener("click", () => this.optionClick(n));
        });
    }

    showOptions() {
        this.vu_select.addClass("active");
        this.option_box.addClass("active");
    }

    hideOptions() {
        this.vu_select.removeClass("active");
        this.option_box.removeClass("active");
        const val = this.main_input.value;
        let match = false;

        this.options.forEach((option) => {
            option.removeClass("hidden");
            if (option.innerText === val || option.get("data-value") === val) {
                match = true;
            }
        });

        if (!match) this.main_input.value = "";
    }

    domHide = (event) => {
        if (!this.vu_select.contains(event.target)) {
            this.hideOptions();
            document.removeEventListener("click", this.domHide);
        }
    };

    optionClick(node) {
        const data = node.dataset;
        this.main_input.value = data.value;
        for (const key in data) {
            const val = data[key];
            const fields = this.vu_select.$(`.${key}`);
            fields.perform((field) => {
                if (field) {
                    field.tagName === "INPUT"
                        ? (field.value = val)
                        : (field.innerText = val);
                }
            });
        }
        this.hideOptions();
    }
}

// // Example usage
// const node = $(".vu-select")[0];
// const fetchOptions = (value, callback) => {
//     ajax({
//         url: "http://localhost:8000/api/airports/" + value,
//         success: (res) => callback(JSON.parse(res)),
//     });
// };

// const optGenerator = (opt, e) =>
//     `<div class="vu-option" data-value="${opt.airport_code}" data-job="${opt.city_code}" data-name="${opt.city_name}">${opt.airport_name}</div>`;

// const yourVuSelect = new vu_select(node, fetchOptions, optGenerator);
