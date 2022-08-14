class AnimalService {
    deleteAnimal(id) {
        return axios.delete(`/animals/${id}`);
    }
}

export default new AnimalService();
