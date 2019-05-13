import { Product } from './product.model';

export class Retailer {
    id: number;
    name: string;
    logo: any;
    description: string;
    website: string;
    products?: Product[];
}