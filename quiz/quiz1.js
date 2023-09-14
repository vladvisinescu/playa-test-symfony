function uniquePermutations(nums) {
    const permutations = [];

    if (nums.length > 8 || nums.length < 1) {
        throw new Error("The number of elements in nums must be greater than or equal 1 and less than or equal to 8");
    }

    for (let i = 0; i < nums.length; i++) {
        if (nums[i] < -10 || nums[i] > 10) {
            throw new Error("The elements in nums array parameter must be between -10 and 10");
        }
    }

    function permutations(nums, currentPermutation) {
        if (nums.length === 0) {
            permutations.push(currentPermutation);
            return;
        }

        for (let i = 0; i < nums.length; i++) {
            const newNums = [...nums];
            const newPermutation = [...currentPermutation, nums[i]];
            newNums.splice(i, 1);

            permutations(newNums, newPermutation);
        }
    }

    permutations(nums, []);

    return permutations;
}

uniquePermutations([1, 2, 3])
uniquePermutations([-8, -2, 5, 1])
