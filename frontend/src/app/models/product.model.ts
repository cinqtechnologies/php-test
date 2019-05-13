import { Retailer } from './retailer.model';

export class Product {
    id: number;
    name: string = "";
    price: number = 0;
    image: string = "";
    description: string = "";
    retailerId: number = 0;

    retailer?: Retailer;
}