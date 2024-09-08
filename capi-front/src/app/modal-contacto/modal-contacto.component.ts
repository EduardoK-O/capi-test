import { Component, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-modal-contacto',
  templateUrl: './modal-contacto.component.html',
  styleUrls: ['./modal-contacto.component.css']
})
export class ModalContactoComponent {
  @Input() contacto: any = { id: 0, nombre: '', notas: '', pagina_web: '' };
  @Input() isEditing: boolean = false;
  @Output() save = new EventEmitter<any>();
  @Output() cancel = new EventEmitter<void>();

  onSave() {
    this.save.emit(this.contacto);
    this.closeModal();
  }

  onCancel() {
    this.cancel.emit();
    this.closeModal();
  }

  closeModal() {
    const modalElement = document.getElementById('contactoModal');
    if (modalElement) {
      const modal = bootstrap.Modal.getInstance(modalElement);
      modal.hide();
    }
  }
}