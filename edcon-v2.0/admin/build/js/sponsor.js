var data = {

    sponsors: []
};
//ViewModel
var vue = new Vue({
    el: '#app',
    data: data,
    mounted() {
        axios.get("https://edcon.io/tp/public/index.php/admin/edcon/speakerList")
            .then(response => {
                this.sponsors = response.data.data

            })
            .catch(function (error) {
                console.log(error);
            })

    },
});

