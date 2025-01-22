MONTHS = [
    {
        abbr: "Jan",
        name: "January",
        days: 31,
        holidays: [],
    },
    {
        abbr: "Feb",
        name: "February",
        days: 28,
        holidays: [],
    },
    {
        abbr: "Mar",
        name: "March",
        days: 31,
        holidays: [],
    },
    {
        abbr: "Apr",
        name: "April",
        days: 30,
        holidays: [],
    },
    {
        abbr: "May",
        name: "May",
        days: 31,
        holidays: [],
    },
    {
        abbr: "Jun",
        name: "June",
        days: 30,
        holidays: [],
    },
    {
        abbr: "Jul",
        name: "July",
        days: 31,
        holidays: [],
    },
    {
        abbr: "Aug",
        name: "August",
        days: 31,
        holidays: [],
    },
    {
        abbr: "Sep",
        name: "September",
        days: 30,
        holidays: [],
    },
    {
        abbr: "Oct",
        name: "October",
        days: 31,
        holidays: [],
    },
    {
        abbr: "Nov",
        name: "November",
        days: 30,
        holidays: {
            22: {
                occasion: "Deepawli",
            },
            23: {
                occasion: "Deepawli",
            },
        },
    },
    {
        abbr: "Dec",
        name: "December",
        days: 31,
        holidays: [],
    },
];
WEEK_DAYS = {
    0: {
        abbr: "Sun",
        name: "Sunday",
    },
    1: {
        abbr: "Mon",
        name: "Monday",
    },
    2: {
        abbr: "Tue",
        name: "Tuesday",
    },
    3: {
        abbr: "Wed",
        name: "Wednesday",
    },
    4: {
        abbr: "Thu",
        name: "Thursday",
    },
    5: {
        abbr: "Fri",
        name: "Friday",
    },
    6: {
        abbr: "Sat",
        name: "Saturday",
    },
};
class Calendar {
    /** Date is in format YYYY-MM-DD */
    constructor({ date, dates_node }) {
        this.MONTHS = MONTHS;
        this.dates_node = dates_node;
        this.today = date ? new Date(date) : new Date();
        this.MONTHS[1]["days"] = this.year % 4 == 0 ? 29 : 28;
        this.month = this.today.getMonth();
        this.year = this.today.getFullYear();
        this.createDates();
    }
    createDates() {
        this.dates = [];
        const firstDay = new Date(this.year, this.month, 0).getDay();
        let date, m, y;
        if (this.month > 0) {
            m = this.month - 1;
            y = this.year;
        } else {
            m = 11;
            y = this.year - 1;
        }
        for (let i = firstDay; i >= 0; i--) {
            date = this.MONTHS[m]["days"] - i;
            this.dates.push(
                this.#createdate(date, new Date(y, m, date).getDay(), m, y)
            );
        }
        for (let i = 0; i < this.MONTHS[this.month]["days"]; i++) {
            this.dates.push(
                this.#createdate(
                    i + 1,
                    new Date(this.year, this.month, i + 1).getDay(),
                    this.month,
                    this.year
                )
            );
        }
        let j = 1;
        if (this.month < 11) {
            m = this.month + 1;
            y = this.year;
        } else {
            m = 0;
            y = this.year + 1;
        }
        for (let i = 7 - new Date(y,m+1,0).getDay(); i < 7; i++) {
            this.dates.push(
                this.#createdate(j++, new Date(y, m, j - 1).getDay(), m, y)
            );
        }
        this.renderDates();
    }
    #createdate(date, day, month, year) {
        let holiday = { is_holiday: false };
        if (day == 0) {
            holiday = { is_holiday: true, occasion: "Sunday" };
        }
        if (date in this.MONTHS[month]["holidays"]) {
            holiday = {
                is_holiday: true,
                ...this.MONTHS[month]["holidays"][date],
            };
        }
        return {
            date,
            day: day,
            week_day: WEEK_DAYS[day],
            month: this.MONTHS[month],
            holiday,
            year,
        };
    }
    getDates() {
        return this.dates;
    }
    nextMonth() {
        this.month < 11 ? this.month++ : (this.month = 0);
        if (this.month == 0) this.year++;
        MONTHS[1]["days"] = this.year % 4 == 0 ? 29 : 28;
        this.createDates();
        return this.dates;
    }
    previousMonth() {
        this.month > 0 ? this.month-- : (this.month = 11);
        if (this.month == 11) this.year--;
        MONTHS[1]["days"] = this.year % 4 == 0 ? 29 : 28;
        this.createDates();
        return this.dates;
    }
    renderDates() {
        console.log(this.dates_node);
        this.dates_node.innerHTML = "";
        this.dates.forEach((date) => {
            this.dates_node.append(
                `<div class="date"><span>${date.date}</span></div>`
            );
        });
    }
}
