export default {
    filters: {
        moment: date => {
            return moment(date).format('Y, ddd, MMM Do');
        },

        time: date => {
            return moment(date).format('H:mm:ss');
        },

        formatted: price => {
            return price / 100;
        }
    }
}

