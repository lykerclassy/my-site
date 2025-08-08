export function getPagination(page: number, pageSize: number): { skip: number; take: number } {
  const take = Math.max(1, Math.min(100, pageSize));
  const skip = (Math.max(1, page) - 1) * take;
  return { skip, take };
}