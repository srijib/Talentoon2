export class ServiceWorkerRegistration implements EventTarget {
  installing: ServiceWorker;
  waiting: ServiceWorker;
  active: ServiceWorker;

  readonly scope: String;
  readonly useCache: boolean;

  constructor() {
    this.installing = null;
    this.waiting = null;
    this.active = null;
  }

  async update(): Promise<void> { }
  async unregister(): Promise<boolean> {
    this.active = null;
    return true;
  }
};