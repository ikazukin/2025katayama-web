/**
 * 見積もりシミュレーター JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('estimate-form');
  const resultSection = document.getElementById('estimate-result');
  const resetButton = document.getElementById('reset-estimate');

  if (!form) return;

  // フォーム送信イベント
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    calculateEstimate();
  });

  // リセットボタン
  if (resetButton) {
    resetButton.addEventListener('click', () => {
      form.reset();
      resultSection.style.display = 'none';
      // フォームまでスクロール
      form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }

  /**
   * 見積もり計算メイン関数
   */
  function calculateEstimate() {
    // フォーム値取得
    const buildingAge = document.getElementById('building-age').value;
    const units = parseInt(document.getElementById('units').value);
    const structure = document.getElementById('structure').value;

    // バリデーション
    if (!buildingAge || !units || !structure) {
      alert('すべての項目を入力してください');
      return;
    }

    if (units < 10 || units > 500) {
      alert('戸数は10〜500の範囲で入力してください');
      return;
    }

    // 係数取得
    const ageCoefficient = getAgeCoefficient(buildingAge);
    const structureCoefficient = getStructureCoefficient(structure);

    // 基本単価（万円/戸）
    const basePrice = 100;

    // 総額計算（万円）
    const baseTotal = units * basePrice * ageCoefficient * structureCoefficient;

    // レンジ（±20%）
    const minPrice = Math.round(baseTotal * 0.8);
    const maxPrice = Math.round(baseTotal * 1.2);

    // 1戸あたり
    const perUnitMin = Math.round((minPrice / units) * 10) / 10;
    const perUnitMax = Math.round((maxPrice / units) * 10) / 10;

    // 結果表示
    displayResult({
      minPrice,
      maxPrice,
      perUnitMin,
      perUnitMax,
      age: getAgeLabel(buildingAge),
      units,
      structure: getStructureLabel(structure)
    });

    // 結果セクションまでスクロール
    resultSection.style.display = 'block';
    setTimeout(() => {
      resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
  }

  /**
   * 築年数係数を取得
   */
  function getAgeCoefficient(age) {
    const coefficients = {
      '0-10': 0.8,
      '10-15': 0.9,
      '15-20': 1.0,
      '20-30': 1.2,
      '30+': 1.4
    };
    return coefficients[age] || 1.0;
  }

  /**
   * 構造係数を取得
   */
  function getStructureCoefficient(structure) {
    const coefficients = {
      'rc': 1.0,
      'src': 1.1,
      's': 0.9,
      'other': 1.0
    };
    return coefficients[structure] || 1.0;
  }

  /**
   * 築年数ラベル取得
   */
  function getAgeLabel(age) {
    const labels = {
      '0-10': '築10年未満',
      '10-15': '築10〜15年',
      '15-20': '築15〜20年',
      '20-30': '築20〜30年',
      '30+': '築30年以上'
    };
    return labels[age] || '-';
  }

  /**
   * 構造ラベル取得
   */
  function getStructureLabel(structure) {
    const labels = {
      'rc': 'RC造（鉄筋コンクリート造）',
      'src': 'SRC造（鉄骨鉄筋コンクリート造）',
      's': 'S造（鉄骨造）',
      'other': 'その他'
    };
    return labels[structure] || '-';
  }

  /**
   * 結果を表示
   */
  function displayResult(data) {
    // 金額表示
    document.getElementById('result-min').textContent = data.minPrice.toLocaleString();
    document.getElementById('result-max').textContent = data.maxPrice.toLocaleString();

    // 1戸あたり
    document.getElementById('result-per-unit-min').textContent = data.perUnitMin.toLocaleString();
    document.getElementById('result-per-unit-max').textContent = data.perUnitMax.toLocaleString();

    // 入力内容
    document.getElementById('result-age').textContent = data.age;
    document.getElementById('result-units').textContent = data.units.toLocaleString();
    document.getElementById('result-structure').textContent = data.structure;
  }

  /**
   * 数値をカンマ区切りに変換
   */
  Number.prototype.toLocaleString = function() {
    return this.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  };
});
