export interface Book {
  id: number;
  title: string;
  author: string;
  description: string;
  totalPages: number;
  createdAt?: Date | number;
}
