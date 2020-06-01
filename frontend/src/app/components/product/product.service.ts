import { Injectable } from '@angular/core';
import { MatSnackBar} from '@angular/material/snack-bar';
import { HttpClient } from '@angular/common/http';
import { Product} from './product.model';
import { Observable } from 'rxjs/internal/Observable';
import { map, catchError } from 'rxjs/operators';
import { EMPTY } from 'rxjs/internal/observable/empty';


@Injectable({
  providedIn: 'root'
})
export class ProductService {

  baseProductUrl = "http://127.0.0.1:8000/api/products/";

  constructor(private snackBar: MatSnackBar, private http: HttpClient) { }

  showMessage(msg: string ,isErro: boolean = false): void {
      this.snackBar.open(msg, 'X', {
         duration: 3000,
         horizontalPosition: "right",
         verticalPosition: "top",  
         panelClass: isErro ? ['msg-error'] : ['msg-success']
      });
  }

  // create new product
  create(product: Product): Observable<Product> {
      return this.http.post<Product>(this.baseProductUrl, product).pipe(
      map(obj => obj),
      catchError(e => this.errorHandler(e)) );
  }
  //list products
  read(): Observable<Product[]> {
    return this.http.get<Product[]>(this.baseProductUrl).pipe(
      map(obj => obj),
      catchError(e => this.errorHandler(e)) );
  }

  //fin  product for id
  readById(id: number): Observable<Product> {
    const url =`${this.baseProductUrl}/${id}`;
      return this.http.get<Product>(url).pipe(
        map(obj => obj),
        catchError(e => this.errorHandler(e)) );
  }

  //update product
  update(product: Product): Observable<Product> {
    const url =`${this.baseProductUrl}/${product.id}`;
    return this.http.put<Product>(url, product).pipe(
      map(obj => obj),
      catchError(e => this.errorHandler(e)) );
  }

  //delete product
  delete(id: number): Observable<Product> {
    const url =`${this.baseProductUrl}/${id}`;
    return this.http.delete<Product>(url).pipe(
      map(obj => obj),
      catchError(e => this.errorHandler(e)) );
  }

  //error
  errorHandler(e: any): Observable<any>{
    this.showMessage(' Ocorreu um erro no backend!', true);
    return EMPTY;
  }



}
