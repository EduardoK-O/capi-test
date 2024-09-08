import { Component, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-modal-contacto',
  templateUrl: './modal-contacto.component.html',
  styleUrls: ['./modal-contacto.component.css']
})
export class ModalContactoComponent {
  @Input() contacto: any = { id: 0, nombre: '', notas: '', pagina_web: '', fecha_cumpleanios: '', telefonos: [], emails: [], direcciones: [] };
  @Input() isEditing: boolean = false;
  @Output() save = new EventEmitter<any>();
  @Output() cancel = new EventEmitter<void>();

  constructor() {
    // Initialize the telefonos, emails, and direcciones arrays if they are not provided
    if (!this.contacto.telefonos) {
      this.contacto.telefonos = [];
    }
    if (!this.contacto.emails) {
      this.contacto.emails = [];
    }
    if (!this.contacto.direcciones) {
      this.contacto.direcciones = [];
    }
  }

  onSave() {
    this.save.emit(this.contacto);
    this.closeModal();
  }

  onCancel() {
    this.cancel.emit();
    this.closeModal();
  }

  addTelefono() {
    this.contacto.telefonos.push({ numero_telefono: '' });
  }

  removeTelefono(index: number) {
    this.contacto.telefonos.splice(index, 1);
  }

  addEmail() {
    this.contacto.emails.push({ email: '' });
  }

  removeEmail(index: number) {
    this.contacto.emails.splice(index, 1);
  }

  addDireccion() {
    this.contacto.direcciones.push({ calle: '', ciudad: '', estado: '', pais: '', codigo_postal: '' });
  }

  removeDireccion(index: number) {
    this.contacto.direcciones.splice(index, 1);
  }

  closeModal() {
    const modalElement = document.getElementById('contactoModal');
    if (modalElement) {
      const modal = bootstrap.Modal.getInstance(modalElement);
      modal.hide();
    }
  }
}
