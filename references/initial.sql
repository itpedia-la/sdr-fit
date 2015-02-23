INSERT INTO `user_group` (`id`, `name`, `permissionList`, `invisible`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, 0, '2015-02-02 00:00:00', '2015-02-02 00:00:00');

INSERT INTO `user` (`id`, `user_group_id`, `login`, `password`, `firstname`, `lastname`, `remember_token`, `systemUser`, `created_at`, `updated_at`) VALUES
(2, 1, 'dsouksavatd@gmail.com', '$2y$10$wO75vkw2Fd9UQIuWlOD6CucVmQWZyU1sPuLbP1yJrCyIpccM2C9Zq', 'Somwang', 'Souksavatd', '5yVOKnkFqIi9wneuwmrN1ZrjhKZnMRHLWNYN6XPjERwjY3blL7qpc9JsbHYz', 0, '2015-02-02 00:00:00', '2015-02-02 14:51:44');

INSERT INTO `user_group_permission` (`id`, `permissionZone`, `permissionTitle`, `permissionDescription`) VALUES
(1, 'ການບໍລິຫານຜູ້ໃຊ້ງານ', 'ເພີ່ມຜູ້ໃຊ້ງານ ( User Add )', 'ອະນຸຍາດໃນການເພີ່ມຜູ້ໃຊ້ງານ'),
(2, 'ການບໍລິຫານຜູ້ໃຊ້ງານ', 'ລົບລ້າງ ( User Remove )', 'ອະນຸຍາດໃຫ້ລົບລ້າງຜູ້ໃຊ້ງານ'),
(3, 'ການບໍລິຫານຜູ້ໃຊ້ງານ', 'ສະແດງລາຍການ ( User List )', 'ອະນຸຍາດໃຫ້ສະແດງລາຍການຜູ້ໃຊ້ງານ'),
(4, 'ການບໍລິຫານຜູ້ໃຊ້ງານ', 'ແກ້ໄຂລະຫັດຜ່ານ ( Change User Password )', 'ອະນຸຍາດໃຫ້ແກ້ໄຂລະຫັດຜ່ານຂອງຜູ້ໃຊ້ງານ'),
(11, 'ຕັ້ງຄ່າ', 'ແກ້ໄຂອັດຕາແລກປ່ຽນ ( Update Exchange Rate )', 'ອະນຸຍາດໃຫ້ແກ້ໄຂອັດຕາແລກປ່ຽນ'),
(12, 'ຕັ້ງຄ່າ', 'ຕັ້ງຄ່າທົ່ວໄປ ( General Setting )', 'ອະນຸຍາດໃຫ້ແກ້ໄຂຄ່າຂໍ້ມູນພື້ນຖານທົ່ວໄປ');