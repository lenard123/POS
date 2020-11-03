var app = new Vue({
    el: '#cashier',

    data: {
        suggestions: [],
        carts: [],
        quantity: 1,
        query: "",
        _q: "",
        searching: false,
        notfound: false,
        selected: {
            code: '???',
            name: '???',
            price: '???',
            quantity: 1,
            description: '???'
        }
    },

    created: function () {
        if (localStorage['carts']) {
            try {
                this.carts = JSON.parse(localStorage['carts']);
            }catch(e){
                localStorage['carts'] = undefined;
            }
        }
    },

    methods: {

        addToCart: function () {
            if (this.selected.code == '???')
                return alert('You need to select a product first.');
            var cart = this.selected;
            cart._quantity = this.quantity;

            if (this.onCart(cart.id)) {
                this.carts.splice(this.getIndex(cart.id), 1, cart);
            } else {
                this.carts.splice(this.carts.length, 0, cart);
            }
        },

        getIndex: function (id) {
            var carts = this.carts;
            for (var i in carts) {
                if (carts[i].id == id)
                    return i;
            }
            return false;
        },

        remove: function (index) {
            this.carts.splice(index, 1);
        },

        onCart: function (id) {
            var carts = this.carts;
            for (var i in carts) {
                if (carts[i].id == id)
                    return true;
            }
            return false;
        },

        search: function (query) {
            if (query == "") {
                this.notfound = false;
                this.suggestions = [];
                this.searching = false;
                return;
            }

            this.notfound = false;

            this._q = query;

            this.suggestions = [];

            this.searching = true;

            return this.getResult(query);
        },

        select: function (item) {
            this.quantity = 1;
            if (item._quantity)
                this.quantity = item._quantity;
            this.selected = item;
            this.query = item.code
        },

        getResult: function (query) {
            if (query != this._q)
                return;
            axios.get('/search?query='+query)
                 .then(response=>this.showResult(response.data, query))
                 .catch(error=>this.getResult(query));
        },

        showResult: function (result, query) {
            if (query != this._q)
                return;
            if (result.length <= 0)
                this.notfound = true;

            this.searching = false;
            this.suggestions = result;
        }
    },

    watch: {
        query: function (val) {
            this.search(val.trim());
        },

        carts: function (val){
            localStorage['carts'] = JSON.stringify(val);
        }
    },

    computed: {
        total: function () {
            var carts = this.carts;
            var price = 0;
            for (var i in carts) {
                price += carts[i]._quantity*carts[i].price;
            }
            return price;
        }
    }
})