const app = new Vue({
   el: '#app',
   data: {
      pageLoading: true,
      showRetailerDetails: false,
      currentPage: 1,
      totalProducts: 0,
      products: []
   },
   mounted(){
      this.getProducts().then(() => {
         document.getElementById('main-content').style.display = null
      })
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
      }
   }
});