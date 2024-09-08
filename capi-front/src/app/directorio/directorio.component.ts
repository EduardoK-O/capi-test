import { Component, OnInit } from '@angular/core';
import { ServicioDirectorioService } from '../services/servicio-directorio.service';

@Component({
  selector: 'app-directorio',
  templateUrl: './directorio.component.html',
  styleUrls: ['./directorio.component.css']
})
export class DirectorioComponent implements OnInit {
  dataSource: Element[] = [];
  filteredData: Element[] = [];
  paginatedData: Element[] = [];
  currentPage = 1;
  pageSize = 10;
  totalPages: number = 0;
  pages: number[] = [];
  filterValue = '';
  selectedContacto: Element = { id: 0, nombre: '', notas: '', pagina_web: '' };
  isEditing: boolean = false;

  constructor(private directorioService: ServicioDirectorioService) { }

  ngOnInit() {
    this.directorioService.obtenerTodos().subscribe(data => {
      this.dataSource = data;
      this.filteredData = this.dataSource;
      this.totalPages = Math.ceil(this.filteredData.length / this.pageSize);
      this.pages = Array.from({ length: this.totalPages }, (_, i) => i + 1);
      this.updatePaginatedData();
    });
  }

  applyFilter() {
    if (this.filterValue) {
      this.filteredData = this.dataSource.filter(element =>
        element.nombre.toLowerCase().includes(this.filterValue.toLowerCase()) ||
        element.notas.toLowerCase().includes(this.filterValue.toLowerCase()) ||
        element.pagina_web.toLowerCase().includes(this.filterValue.toLowerCase())
      );
    } else {
      this.filteredData = this.dataSource;
    }
    this.totalPages = Math.ceil(this.filteredData.length / this.pageSize);
    this.pages = Array.from({ length: this.totalPages }, (_, i) => i + 1);
    this.updatePaginatedData();
  }

  updatePaginatedData() {
    const start = (this.currentPage - 1) * this.pageSize;
    const end = start + this.pageSize;
    this.paginatedData = this.filteredData.slice(start, end);
  }

  previousPage() {
    if (this.currentPage > 1) {
      this.currentPage--;
      this.updatePaginatedData();
    }
  }

  nextPage() {
    if (this.currentPage < this.totalPages) {
      this.currentPage++;
      this.updatePaginatedData();
    }
  }

  goToPage(page: number) {
    if (page >= 1 && page <= this.totalPages) {
      this.currentPage = page;
      this.updatePaginatedData();
    }
  }

  openModal(contacto: Element = { id: 0, nombre: '', notas: '', pagina_web: '' }) {
    this.selectedContacto = { ...contacto };
    this.isEditing = contacto.id !== 0;
    const modal = document.getElementById('contactoModal');
    if (modal) {
      const bootstrapModal = new bootstrap.Modal(modal);
      bootstrapModal.show();
    }
  }

  guardarContacto(contacto: Element) {
    if (this.isEditing) {
      this.directorioService.editar(contacto.id, contacto).subscribe(() => {
        this.dataSource = this.dataSource.map(e => e.id === contacto.id ? contacto : e);
        this.filteredData = this.dataSource;
        this.totalPages = Math.ceil(this.filteredData.length / this.pageSize);
        this.pages = Array.from({ length: this.totalPages }, (_, i) => i + 1);
        this.updatePaginatedData();
      });
    } else {
      this.directorioService.guardar(contacto).subscribe((nuevoContacto: Element) => {
        this.dataSource.push(nuevoContacto);
        this.filteredData = this.dataSource;
        this.totalPages = Math.ceil(this.filteredData.length / this.pageSize);
        this.pages = Array.from({ length: this.totalPages }, (_, i) => i + 1);
        this.updatePaginatedData();
      });
    }
  }

  onCancel() {
    // Close modal logic if needed
  }

  eliminarContacto(id: number) {
    console.log('Eliminando elemento con id', id);
    this.directorioService.eliminar(id).subscribe(() => {
      this.dataSource = this.dataSource.filter(e => e.id !== id);
      this.filteredData = this.dataSource;
      this.totalPages = Math.ceil(this.filteredData.length / this.pageSize);
      this.pages = Array.from({ length: this.totalPages }, (_, i) => i + 1);
      this.updatePaginatedData();
    });
  }
}

export interface Element {
  id: number;
  nombre: string;
  notas: string;
  pagina_web: string;
}
