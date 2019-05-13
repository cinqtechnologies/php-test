import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';
import { FeedbackModalComponent } from '../feedback-modal/feedback-modal.component';
import { IFeedback } from 'src/app/contracs/IFeedback';

@Component({
  selector: 'app-product-details-email',
  templateUrl: './product-details-email.component.html',
  styleUrls: ['./product-details-email.component.css']
})
export class ProductDetailsEmailComponent implements OnInit {

  constructor(
    public dialogRef: MatDialogRef<FeedbackModalComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any
  ) { }

  ngOnInit() {
  }

}
