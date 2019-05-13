import { Retailer } from './retailer.model';

export class Product {
    id: number;
    name: string = "";
    price: number = 0;
    image: any;
    description: string = "";
    retailerId: number = 0;

    retailer?: Retailer;
}