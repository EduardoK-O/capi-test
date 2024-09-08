import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { ServicioDirectorioService } from '../services/servicio-directorio.service';

@Component({
  selector: 'app-directorio',
  templateUrl: './directorio.component.html',
  styleUrl: './directorio.component.css'
})
export class DirectorioComponent implements OnInit, AfterViewInit {

  displayedColumns: string[] = ['id','nombre', 'notas', 'pagina_web'];
  dataSource = new MatTableDataSource<Element>();

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private directorioService: ServicioDirectorioService) { }

  ngOnInit() {
    this.directorioService.obtenerTodos().subscribe(data => {
      this.dataSource.data = data;
    })
  }

  ngAfterViewInit() {
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  
    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }
}

export interface Element {
  id: number;
  nombre: string;
  notas: string,
  pagina_web: string
}
