class Attendance {
    #LEAVE_URL = "";
    #SUMMARY_URL = "";
    #SECONDS = 8 * 60 * 60; /* 8 Hours */
    #LUNCH_TIME = 30 * 60; /* 30 Minutes */
    #BREAK_TIME = 10 * 60; /* 10 Minutes */
    #DAY_TIMER = null;
    #TIMER = null;
    #TIMING = null;
    #LOCAL = null;
    #countDisplay = [];
    #timerDisplay = [];

    constructor(config) {
        this.config = config;
        let t = new Date();
        t = `${t.getDate()}-${t.getMonth()}-${t.getFullYear()}`;
        this.#LOCAL = `${t}_activity`;
        this.activities = localStorage.getJson(this.#LOCAL) || {
            logs: [],
            total_break: 0,
        };
        this.activities.time_left = this.activities.time_left || this.#SECONDS;
        if (this.activities.time_left == this.#SECONDS) {
            this.#add_entry(this.#entry_blueprint({ action: "Day Started" }));
        }
        if (localStorage.getItem("logging")) {
            localStorage.removeItem("logging");
            this.#add_entry(
                this.#entry_blueprint({ action: "User Logged In" })
            );
        }
        this.#add_entry(
            this.#entry_blueprint({ action: "Opened Page " + location.href })
        );
        this.__init_day__();
    }

    __init_day__() {
        this.#start_day_timer();
    }
    __halt_day__() {
        this.#stop_day_timer();
        ajax({
            url: this.#SUMMARY_URL,
            data: { log: this.activities.logs },
            success: (res) => {},
        });
    }

    __init_lunch__() {
        this.#add_entry(this.#entry_blueprint({ action: "Lunch Started" }));
        this.#init_timer(this.#LUNCH_TIME);
    }
    __halt_lunch__() {
        this.#add_entry(this.#entry_blueprint({ action: "Lunch Ended" }));
        this.#halt_timer();
    }

    __init_break__() {
        this.#add_entry(this.#entry_blueprint({ action: "Break Started" }));
        this.#init_timer(this.#BREAK_TIME);
    }
    __halt_break__() {
        this.#add_entry(this.#entry_blueprint({ action: "Break Ended" }));
        this.#halt_timer();
    }

    request_halfday() {
        ajax({
            url: this.#LEAVE_URL,
            data: {},
            success: (res) => {},
        });
    }
    request_leave() {
        ajax({
            url: this.#LEAVE_URL,
            data: {},
            success: (res) => {},
        });
    }
    #start_day_timer() {
        this.#DAY_TIMER = setInterval(() => {
            this.activities.time_left--;
            this.#countDisplay.forEach((display) => {
                this.#use_timerui(display, this.activities.time_left);
            });
            localStorage.setJson(this.#LOCAL, this.activities);
        }, 1000);
    }
    #stop_day_timer() {
        clearInterval(this.#DAY_TIMER);
    }
    #init_timer(seconds) {
        if (this.#TIMER) return;
        this.#stop_day_timer();
        this.#TIMING = seconds;
        this.#timerDisplay.forEach((display) => {
            this.#use_timerui(display, this.#TIMING);
        });
        this.activities.total_break += seconds;
        this.#TIMER = setInterval(() => {
            this.#TIMING--;
            this.#timerDisplay.forEach((display) => {
                this.#use_timerui(display, this.#TIMING);
            });
        }, 1000);
    }
    #halt_timer() {
        clearInterval(this.#TIMER);
        this.#TIMER = null;
        if (this.#TIMING < 0) {
            this.activities.time_left -= this.#TIMING;
        }
        this.activities.total_break -= this.#TIMING;
        this.#start_day_timer();
    }
    #add_entry(data) {
        this.activities.logs.push(data);
        localStorage.setJson(this.#LOCAL, this.activities);
    }
    create_entry(data) {
        if (this.#TIMER) return;
        this.#add_entry(this.#entry_blueprint(data));
    }
    #entry_blueprint(data) {
        let instance = new Date();
        return {
            ...{
                time: {
                    hour: instance.getHours(),
                    min: instance.getMinutes(),
                    sec: instance.getSeconds(),
                },
                timestamp: instance.getTime(),
                timeLeft: this.activities.time_left,
                origin: location.href,
            },
            ...data,
        };
    }
    renderCountdown(node) {
        if (node[0]) {
            this.#countDisplay.push(...node);
        } else {
            this.#countDisplay.push(node);
        }
    }
    renderTimer(node) {
        if (node[0]) {
            this.#timerDisplay.push(...node);
        } else {
            this.#timerDisplay.push(node);
        }
    }
    #use_timerui(node, time) {
        let refactor = (input) => String(input).padStart(2, "0");
        if (time > 0) {
            node.$(".hours")[0].innerHTML =
                refactor(Math.floor(time / (60 * 60))) + "<i>H</i>";
            node.$(".mins")[0].innerHTML =
                refactor(Math.floor((time % (60 * 60)) / 60)) + "<i>M</i>";
            node.$(".secs")[0].innerHTML =
                refactor(Math.floor(time % 60)) + "<i>S</i>";
        } else {
            node.$(".hours")[0].innerHTML =
                refactor(Math.ceil(time / (60 * 60))) + "<i>H</i>";
            node.$(".mins")[0].innerHTML =
                refactor(Math.ceil((time % (60 * 60)) / 60)) + "<i>M</i>";
            node.$(".secs")[0].innerHTML =
                refactor(Math.ceil(time % 60)) + "<i>S</i>";
        }
    }
}
