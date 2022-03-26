import { http } from "./config";

class ListsDataService {
    getAll() {
      return http.get(`/expenses`);
    }
    get(id) {
      return http.get(`/expenses/${id}`);
    }
    create(data) {
      return http.post("/expenses", data);
    }
    update(id, data) {
      return http.put(`/expenses/${id}`, data);
    }
    delete(id) {
      return http.delete(`/expenses/${id}`);
    }
  }
export default new ListsDataService();