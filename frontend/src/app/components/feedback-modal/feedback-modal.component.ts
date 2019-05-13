import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MAT_DIALOG_DATA } from '@angular/material';
import { IFeedback } from 'src/app/contracs/IFeedback';

@Component({
  selector: 'app-feedback-modal',
  templateUrl: './feedback-modal.component.html',
  styleUrls: ['./feedback-modal.component.css']
})
export class FeedbackModalComponent implements OnInit {
  
  constructor(
    public dialogRef: MatDialogRef<FeedbackModalComponent>,
    @Inject(MAT_DIALOG_DATA) public data: IFeedback
    ) { }

  ngOnInit() {
  }

}
