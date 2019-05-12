import { Retailer } from './retailer.model';

export class Product {
    id: number;
    name: string;
    price: number;
    image: string;
    description: string;
    retailerId: number;    

    retailer?: Retailer;
}