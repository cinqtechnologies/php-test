const app = new Vue({
   el: '#app',
   data: {
      pageLoading: true,
      showRetailerDetails: false,
      currentPage: 1,
      totalProducts: 0,
      products: [],
      retailer: null
   },
   mounted(){
      this.getProducts().then(() => {
         document.getElementById('main-content').style.display = null
      })
   },
   
   computed: {
      labelProducts(){
         return this.showRetailerDetails ? "Retailer's Products" : 'Products'
      }
   },
   
   methods: {
      getProducts(retailerId = ''){
         this.pageLoading = true
         return axios
            .get('/products/'+this.currentPage+'/'+retailerId)
            .then(res => {
               this.products = res.data.products.data
               this.totalProducts = res.data.products.total
            })
            .then( () => {
               this.pageLoading = false
            })
            .catch(error => console.log(error))
      },

      productsByRetailer(retailerId){
         axios
            .get('/retailer/'+retailerId)
            .then(res => {
               this.retailer = res.data.retailer
               this.showRetailerDetails = true
            })
            .catch(error => console.log(error))

         this.getProducts(retailerId)
      },

      dismissRetailerFilter(){
         this.getProducts()
         this.showRetailerDetails = false
      }
   }
});