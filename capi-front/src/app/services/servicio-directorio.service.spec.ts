import { TestBed } from '@angular/core/testing';

import { ServicioDirectorioService } from './servicio-directorio.service';

describe('ServicioDirectorioService', () => {
  let service: ServicioDirectorioService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ServicioDirectorioService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
