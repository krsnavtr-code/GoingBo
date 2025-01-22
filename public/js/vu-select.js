class vu_select {
    constructor(node, config = {}) {
        this.node = node;
        this.content_box = node.$(".vu-content")[0];
        this.suggest_box = node.$(".vu-suggestion")[0];
        this.input = node.$(".vu-input")[0];

        this.optionGenerator = config.optionGenerator;
        this.fetchOptions = config.fetchOptions;

        if (this.fetchOptions) {
            this.options = [];
        } else if (config.options) {
            this.options = this.populateOptions(config.options);
        } else {
            this.options = this.suggest_box.$(".vu-option");
            this.options.perform((n) => {
                n.addEventListener("click", () => this.optionClick(n));
            });
        }

        this.content_box.addEventListener("click", () => {
            this.input.focus();
            // this.suggest_box.hasClass("active")
            //     ? this.hide_suggestions()
            //     : this.show_suggestions();
            document.addEventListener("click", this.domHide);
        });
        this.input.addEventListener("input", () => this.handleInput());
    }
    handleInput() {
        const val = this.input.value.trim().toLowerCase();
        if (this.fetchOptions) {
            if (val == "") {
                this.hide_suggestions();
                return;
            }
            this.fetchOptions(val, (opt) => {
                this.populateOptions(opt);
                this.show_suggestions();
            });
        } else {
            this.options.perform((n) => {
                let inner = (n.innerText ?? "").toLowerCase();
                let nVal = (n.get("data-value") ?? "").toLowerCase();
                if (inner.indexOf(val) < 0 && nVal.indexOf(val) < 0) {
                    n.addClass("unmatch");
                } else {
                    n.removeClass("unmatch");
                }
            });
            this.show_suggestions();
        }
    }
    populateOptions(opt) {
        this.suggest_box.innerHTML = "";
        opt.forEach((option) =>
            this.suggest_box.insert(2,this.optionGenerator(option))
        );
        this.options = this.suggest_box.$(".vu-option");
        this.options.perform((n) => {
            n.addEventListener("click", () => this.optionClick(n));
        });
    }
    show_suggestions() {
        this.node.addClass("active");
        this.suggest_box.addClass("active");
    }
    hide_suggestions() {
        this.node.removeClass("active");
        this.suggest_box.removeClass("active");
    }
    domHide = (event) => {
        if (!this.node.contains(event.target)) {
            this.hide_suggestions();
            document.removeEventListener("click", this.domHide);
        }
    };
    optionClick(node) {
        const data = node.dataset;
        this.input.value = data.value;
        for (const key in data) {
            const val = data[key];
            const fields = this.content_box.$(`.${key}`);
            fields.perform((field) => {
                if (field) {
                    field.tagName === "INPUT"
                        ? (field.value = val)
                        : (field.innerText = val);
                }
            });
        }
        this.hide_suggestions();
    }
}
