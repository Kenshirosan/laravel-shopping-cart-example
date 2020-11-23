export default {
    filters: {
        moment: date => {
            return moment(date).format('Y, ddd, MMM Do');
        },

        time: date => {
            return moment(date).format('H:mm:ss');
        },

        formatted: price => {
            return price;
        },
// TODO :
        tel: phone => {
            console.log(phone, 'OUIN');
            phone = phone.replace('(', '');
            phone = phone.replace(')', '');
            phone = phone.replace('-', ' ');
            // '/[() -]/'
            console.log(phone, 'OUIN');
            return phone;
        },
    },
};
