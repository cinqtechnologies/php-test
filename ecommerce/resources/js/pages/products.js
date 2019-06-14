const app = new Vue({
   el: '#app',
   data: {
      pageLoading: true,
      showRetailerDetails: false,
      products: [],
      retailer: {
         id: ''
      },
      currentPage: 1,
      totalPages: 1
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
      getProducts(page = 1){
         this.pageLoading = true
         this.currentPage = page
         
         return axios
            .get('/products/'+this.retailer.id+'?page='+page)
            .then(res => {
               this.products = res.data.products.data
               this.totalPages = res.data.products.last_page
            })
            .then( () => {
               this.pageLoading = false
            })
            .catch(error => console.log(error))
      },

      productsByRetailer(retailerId){
         this.retailer.id = retailerId
         this.getProducts()

         axios
            .get('/retailer/'+retailerId)
            .then(res => {
               this.retailer = Object.assign({}, this.retailer, res.data.retailer)
               this.showRetailerDetails = true
            })
            .catch(error => console.log(error))
      },

      dismissRetailerFilter(){
         this.retailer.id = ''
         this.getProducts()
         this.showRetailerDetails = false
      }
   }
});